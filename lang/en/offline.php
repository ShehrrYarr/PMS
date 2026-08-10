<?php

declare(strict_types=1);

return [
    'title' => 'Offline Point of Sale',
    'go_offline' => 'Go Offline',
    'open_offline_till' => 'Open Offline Till',
    'sync_sales' => 'Sync Sales',
    'sync_sales_count' => 'Sync Sales (:count)',
    'online' => 'Online',
    'offline' => 'Offline',
    'back_to_online_pos' => 'Back to Online POS',
    'online_pos_needs_connection' => 'The online POS needs an internet connection. Keep selling here — your sales are saved on this device and will post when the connection returns.',

    'offline_ready' => 'This device is ready to sell offline.',
    'offline_ready_not_persisted' => 'Ready to sell offline, but this browser would not guarantee storage. Sync often.',
    'offline_prepare_failed' => 'Could not prepare offline mode. Check your connection and try again.',

    'not_prepared_title' => 'This device is not set up for offline selling',
    'not_prepared_hint' => 'Connect to the internet, open the Point of Sale screen, and choose "Go Offline" first.',

    'data_age' => 'Data is :hours hours old',
    'stale_warning' => 'This device has been offline for over a day. Stock levels and customer balances may have changed.',
    'pending_sales' => 'Pending sales',
    'sync_result' => 'Synced :synced sale(s), :rejected rejected.',
    'sync_failed' => 'Could not sync. Check your connection and try again.',
    'sign_in_to_sync' => 'Your session expired. Sign in again to sync — your sales are safe on this device.',

    'unbalanced_payment' => 'The payment amounts must add up to the sale total.',
    'invalid_quantity' => 'Quantity for :product must be a whole number of at least 1.',
    'invalid_price' => 'Price for :product cannot be negative.',
    'insufficient_stock' => 'Not enough stock cached for :product.',
    'invalid_discount' => 'Discount on :product is invalid — check it is not negative, not over 100%, and not more than the item costs.',
    'invalid_sale_discount' => 'The sale discount is invalid — check it is not negative, not over 100%, and not more than the total.',
    'payment_required' => 'Add at least one payment line with a valid amount.',
    'balance_as_of' => 'Balance :balance (as of download)',
    'download_invoice' => 'Download Invoice PDF',
    'print_receipt' => 'Print Receipt',
    'queued_note' => 'Saved on this device. It will post to the server on the next sync.',
    'logout_blocked' => 'This device still has :count offline sale(s) that have not reached the server. Signing out now leaves them stranded here. Sync first, or press OK only if you know what you are doing.',
    'hold_failed' => 'Could not save that held order on this device. Try again.',
    'sale_save_failed' => 'The sale could not be saved on this device, so nothing was recorded. Try again.',
    'receipt_blocked' => 'The receipt window was blocked by your browser. The sale is saved — allow pop-ups and use Print Receipt.',
    'till_unavailable' => 'The offline till could not start on this device. Reload the page, and if it persists this browser may be blocking local storage.',
    'needs_login' => 'Sign in required',
    'remaining' => 'Remaining',
    'remove_payment_line' => 'Remove payment line',
    'remove_item' => 'Remove item',
];
