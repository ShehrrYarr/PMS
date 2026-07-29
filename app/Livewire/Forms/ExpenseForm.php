<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use App\Enums\PaymentMethod;
use App\Models\Expense;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class ExpenseForm extends Form
{
    public ?Expense $expense = null;

    #[Validate('required|date')]
    public string $date = '';

    #[Validate('required|numeric|min:0.01')]
    public string $amount = '';

    #[Validate('required|exists:expense_categories,id')]
    public ?int $expense_category_id = null;

    #[Validate('required|in:cash,bank')]
    public string $payment_method = 'cash';

    #[Validate('nullable|exists:banks,id')]
    public ?int $bank_id = null;

    #[Validate('nullable|exists:vendors,id')]
    public ?int $vendor_id = null;

    #[Validate('nullable|string|max:1000')]
    public string $description = '';

    #[Validate('nullable|image|max:5120')]
    public ?TemporaryUploadedFile $receiptPhoto = null;

    public function rules(): array
    {
        return [
            'bank_id' => [
                Rule::requiredIf($this->payment_method === PaymentMethod::Bank->value),
                'nullable',
                'exists:banks,id',
            ],
        ];
    }

    public function setExpense(Expense $expense): void
    {
        $this->expense = $expense;
        $this->date = $expense->date->format('Y-m-d');
        $this->amount = (string) $expense->amount;
        $this->expense_category_id = $expense->expense_category_id;
        $this->payment_method = $expense->payment_method;
        $this->bank_id = $expense->bank_id;
        $this->vendor_id = $expense->vendor_id;
        $this->description = (string) $expense->description;
        $this->receiptPhoto = null;
    }

    /**
     * @return array<string, mixed>
     */
    public function attributesForSave(): array
    {
        return [
            'date' => $this->date,
            'amount' => $this->amount,
            'expense_category_id' => $this->expense_category_id,
            'payment_method' => $this->payment_method,
            'bank_id' => $this->payment_method === PaymentMethod::Bank->value ? $this->bank_id : null,
            'vendor_id' => $this->vendor_id,
            'description' => $this->description !== '' ? $this->description : null,
        ];
    }

    public function storePhotoFor(Expense $expense): void
    {
        if ($this->receiptPhoto === null) {
            return;
        }

        $expense->update([
            'receipt_photo_path' => $this->receiptPhoto->storeAs('expense-receipts', "{$expense->id}.jpg", 'public'),
        ]);
    }

    public function resetForm(): void
    {
        $this->expense = null;
        $this->reset(['expense_category_id', 'bank_id', 'vendor_id', 'description', 'receiptPhoto']);
        $this->date = now()->format('Y-m-d');
        $this->amount = '';
        $this->payment_method = PaymentMethod::Cash->value;
    }
}
