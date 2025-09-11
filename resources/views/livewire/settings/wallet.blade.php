<?php

use App\Models\User;
use Goldoni\LaravelVirtualWallet\Enums\TransferStatus;
use Goldoni\LaravelVirtualWallet\Facades\Wallet;
use Livewire\Volt\Component;

new class extends Component {
    public function mount()
    {
        $user = User::first();
        $buyer = User::find(2);
        $seller = User::find(3);
        Wallet::for($user)->label('main')->currency('EUR')->credit('100.00');
        Wallet::for($buyer)->label('main')->currency('EUR')->credit('100.00');
        Wallet::for($user)->label('main')->currency('EUR')->debit('25.00');
        Wallet::for($buyer)->label('main')->currency('EUR')->transfer($seller, '35.00', ['status' => TransferStatus::PENDING]);
        $entries = Wallet::for($user)->label('main')->currency('EUR')->history();
        Wallet::for($buyer)
            ->label('main')->currency('EUR')
            ->transfer($seller, '35.00', ['status' => 'pending']);
        $balance = Wallet::for($user)->label('main')->currency('EUR')->balance();
        $wallets = Wallet::for($user)->wallets();
        $totals = Wallet::for($user)->totalBalanceByCurrency();
        dd($entries, $balance, $wallets, $totals);
    }
}; ?>

<div>
    //
</div>
