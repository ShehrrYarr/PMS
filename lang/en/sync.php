<?php

declare(strict_types=1);

return [
    'conflicts_title' => 'Sync Conflicts',
    'conflicts_hint' => 'These offline sales were saved even though the batch had already been sold elsewhere, because the customer had already paid and taken the goods. The batch is now short by the amount shown — it will correct itself on the next purchase of that batch, or you can adjust stock manually.',
    'unresolved' => 'Needs review',
    'show_resolved' => 'Show resolved',
    'invoice' => 'Invoice',
    'product' => 'Product',
    'sold' => 'Sold',
    'available' => 'Was available',
    'shortfall' => 'Short by',
    'status' => 'Status',
    'needs_review' => 'Needs review',
    'resolved_by' => 'Resolved by :name',
    'mark_resolved' => 'Mark resolved',
    'resolve_confirm' => 'Mark this conflict as reviewed? The stock figure itself is not changed.',
    'conflict_resolved' => 'Conflict marked as reviewed.',
    'none' => 'No sync conflicts. Every offline sale matched available stock.',
    'replay_failed' => 'This sale could not be posted. It is still saved on the device — contact support with the invoice number.',
];
