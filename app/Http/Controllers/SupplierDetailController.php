<?php

namespace App\Http\Controllers;

use App\Models\CompanyDetail;
use App\Models\SupplierDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\IngredientsImport;
use App\Exports\IngredientsExport;

class SupplierDetailController extends Controller
{
    public function company_index() {
        $companies = CompanyDetail::all();
        return view('ManageSupplier.companyManage', compact('companies'));
    }

    public function createSupplier() {
        return view('ManageSupplier.addSupplier');
    }

    public function upload_excel_file(Request $request) {
        $validator = Validator::make($request->all(), [
            'ingredients_list' => 'required|file|mimes:xlsx,xls',
            'company_name' => 'required|string',
            'company_address' => 'required|string',
            'company_photo' => 'required|image', // Ensure the uploaded file is an image
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        // Check if the number of companies exceeds 5
        if (CompanyDetail::count() > 4) {
            return back()->with('error', 'Only five companies are allowed.');
        }
    
        if ($request->hasFile('company_photo')) {
            $fileName = $request->file('company_photo')->getClientOriginalName();
            $request->file('company_photo')->storeAs('company_photos', $fileName, 'public');
        } else {
            return back()->with('error', 'No company photo uploaded.');
        }
    
        // Create a new company
        $company = CompanyDetail::create([
            'company_name' => $request->input('company_name'),
            'company_address' => $request->input('company_address'),
            'company_photo' => $fileName,
        ]);
    
        // Get the company_ID & company_name
        $companyId = $company->company_ID;
        $companyName = $company->company_name;
    
        // Upload and import the Excel file
        if ($request->hasFile('ingredients_list')) {
            try {
                $file = $request->file('ingredients_list');
                $filePath = $file->storeAs('excel', $file->getClientOriginalName());
    
                // Ensure the file was stored correctly
                if (!Storage::exists($filePath)) {
                    throw new \Exception('File upload failed.');
                }
    
                $importFilePath = storage_path('app/' . $filePath);
    
                // Rename the excel file with proper name
                $newFileName = $companyName . '_ingredients_list.xlsx';
                $newFilePath = storage_path('app/excel/' . $newFileName);
    
                if (!rename($importFilePath, $newFilePath)) {
                    throw new \Exception('Failed to rename the file.');
                }
    
                // Pass the company_ID to the IngredientsImport constructor
                Excel::import(new IngredientsImport($companyId), $newFilePath);
            } catch (\Exception $e) {
                return back()->with('error', 'No Ingredient Price');
            }
        } else {
            return back()->with('error', 'No ingredients list uploaded.');
        }
    
        return redirect(route('company.manage'))->with('success', 'Company and ingredients list uploaded successfully.');
    }

    public function editSupplier($company_name) {

        $company = CompanyDetail::where('company_name', $company_name)->firstOrFail();
        $supplier = $company->suppliers()->firstOrFail();
        return view('ManageSupplier.editSupplier', compact('supplier'));
    }

    public function updateSupplier(Request $request, $companyId)
    {
        $request->validate([
            'company_name' => 'required|string',
            'company_address' => 'required|string',
            'ingredients_list' => 'required|file|mimes:xlsx,xls',
        ]);

        // Retrieve the company details
        $company = CompanyDetail::findOrFail($companyId);

        // Update company details
        $company->update([
            'company_name' => $request->input('company_name'),
            'company_address' => $request->input('company_address'),
        ]);

        $companyId = $company->company_ID;
        $companyName = $company->company_name;

        // Upload and import the Excel file
        $file = $request->file('ingredients_list');
        $filePath = $file->storeAs('excel', $file->getClientOriginalName());
        $importFilePath = storage_path('app/excel/ingredients_list.xlsx');

        // Rename the excel file with proper name
        $newFileName = $companyName . '_ingredients_list.xlsx';
        rename($importFilePath, storage_path('app/excel/' . $newFileName));

        // Pass the company_ID to the IngredientsImport constructor
        Excel::import(new IngredientsImport($companyId), storage_path('app/excel/' . $newFileName));

        return redirect()->route('ingredient.manage')->with('success', 'Supplier details and Excel file updated successfully.');
    }
    

    public function deleteSupplier($id) {
        $dataCompany = CompanyDetail::find($id);
        $dataSupplier = SupplierDetail::where('company_ID',$id)->delete();
        $dataCompany -> delete();
        return redirect(route('company.manage'));
    }
}
