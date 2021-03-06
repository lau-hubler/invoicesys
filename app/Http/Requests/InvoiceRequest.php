<?php

namespace App\Http\Requests;

use App\Company;
use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'invoice_date' => 'required | date',
            'delivery_date' => 'required_unless:status_id,1 | date | after_or_equal:invoice_date',
            'due_date' => 'required | date | after_or_equal:delivery_date',
            'client' => 'required | exists:companies,name',
            'vendor' => 'required | exists:companies,name| different:client',
            'status_id' => 'required'
        ];
    }
    
    public function messages()
    {
        
        return [
            'delivery_date.required_unless' => 'The delivery date field is required unless status is draft.',
        ];
    }
    
    /**
     * Return validated data with client and vendor in ID form to store
     * @return array
     */
    public function invoiceData()
    {
        $data = $this->validated();
        
        $client_id = Company::all()->keyBy('name')->get($this->validated()['client'])->id;
        $data['client_id'] = $client_id;
        unset($data['client']);
    
        $vendor_id = Company::all()->keyBy('name')->get($this->validated()['vendor'])->id;
        $data['vendor_id'] = $vendor_id;
        unset($data['vendor']);
        
        return $data;
    }
}
