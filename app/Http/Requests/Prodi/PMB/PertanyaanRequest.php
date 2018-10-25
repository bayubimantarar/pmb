<?php

namespace App\Http\Requests\Prodi\PMB;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Prodi\PMB\NamaFileSpreadsheet;

class PertanyaanRequest extends FormRequest
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
        if($this->method() == 'POST'){
            switch($this->get('metode')){
                case 'form': {
                    return [
                        'metode' => 'required',
                        'pertanyaan.*' => 'required',
                        'gambar.*' => 'mimes:jpeg,jpg,png|max:2000'
                    ];
                }
                case 'unggah' : {
                    return [
                        'metode' => 'required',
                        'file_spreadsheet' => [
                            'required',
                            'mimes:xlsx,xls,bin,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/octet-stream'
                        ],
                        'nama_file_spreadsheet' => [new NamaFileSpreadSheet($this->get('kode_soal'))]
                    ];
                }
                default: {
                    return [
                        'metode' => 'required'
                    ];
                };
            }
        }else if($this->method() == 'PUT'){
            return [
                'pertanyaan.*' => 'required',
                'gambar.*' => 'mimes:jpeg,jpg,png|max:2000'
            ];
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'pertanyaan.*.required' => 'Pertanyaan Perlu diisi.',
            'gambar.*.mimes' => 'Gambar harus bertipe [JPEG/ JPG/ PNG]',
            'file_spreadsheet.required' => 'File spreadsheet perlu disisipkan',
            'file_spreadsheet.mimes' => 'File Spreadsheet harus bertipe [XLSX/ XLS]',
            'metode.required' => 'Pilih salah satu metode pembuatan pertanyaan'
        ];
    }
}
