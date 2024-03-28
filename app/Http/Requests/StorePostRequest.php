<?php

namespace App\Http\Requests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'kategori_kode' => 'required',
            'kategori_nama' => 'required',
            'username' => 'required',
            'nama' => 'required',
            'password' => 'required',
            'id_level' => 'required',
            'level_kode' => 'required',
            'level_name' => 'required',
        ];
    }

    public function store(StorePostRequest $request): RedirectResponse {
        $validated = $request->validated();
        $validated = $request->save()->only(['kategori_kode'], 'kategori_nama');
        $validated = $request->save()->expect(['kategori_kode'], 'kategori_nama');
        
        $validated = $request->validated();
        $validated = $request->safe()->only(['username', 'nama', 'password', 'id_level']);
        $validated = $request->safe()->except(['username', 'nama', 'password', 'id_level']);
        
        return redirect('/kategori');
        return redirect('/user');
    }
}

