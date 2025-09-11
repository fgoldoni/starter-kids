<?php

use Goldoni\LaravelVirtualWallet\Facades\Wallet;
use Livewire\Volt\Component;

new class extends Component {
    public function mount()
    {
        $user = \App\Models\User::first();
        $buyer = \App\Models\User::find(2);
        $seller = \App\Models\User::find(3);
        Wallet::for($user)->label('main')->currency('EUR')->credit('100.00');
        Wallet::for($buyer)->label('main')->currency('EUR')->credit('100.00');
        Wallet::for($user)->label('main')->currency('EUR')->debit('25.00');
        Wallet::for($buyer)->label('main')->currency('EUR')->transfer($seller, '35.00');
        $entries = Wallet::for($user)->label('main')->currency('EUR')->history();
        $balance = Wallet::for($user)->label('main')->currency('EUR')->balance();
        $wallets = Wallet::for($user)->wallets();
        dd($entries, $balance);
    }
}; ?>

<div>
    //
</div>
