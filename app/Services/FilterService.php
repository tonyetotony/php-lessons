<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FilterService
{
    public function scopeApply($query, Request $request): Builder
    {
        if ($request->has('name') && $request->get('name')) {
            $query->where('name', 'like', '%' . $request->get('name') . '%');
        }

        if ($request->has('slug') && $request->get('slug')) {
            $query->where('slug', $request->get('slug'));
        }

        if ($request->has('email') && $request->get('email')) {
            $query->where('email', $request->get('email'));
        }

        if ($request->has('active') && $request->get('active') !== null) {
            $query->where('active', $request->get('active'));
        }

        if ($request->has('date_from') && $request->get('date_from') !== null) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->get('date_to') !== null) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        return $query;
    }
}