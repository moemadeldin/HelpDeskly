<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\TicketPriority;
use App\Models\TicketAttachment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->isCustomer();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'subject' => ['required', 'string'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'string', 'exists:categories,id'],
            'priority' => ['required', Rule::in(TicketPriority::cases())],
            'attachments' => ['nullable', 'array', 'max:'.TicketAttachment::ALLOWED_NUMBER_OF_ATTACHMENTS],
            'attachments.*' => ['file', 'mimes:png,jpg,jpeg,pdf,doc,docx,txt', 'max:10240'],
        ];
    }
}
