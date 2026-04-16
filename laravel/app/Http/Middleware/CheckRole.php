<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userRole = auth()->user()->role;

        // Nếu roles truyền vào là số (0,1) hoặc tên, bạn có thể chuyển đổi
        // Ở đây ta so sánh trực tiếp với giá trị số
        if (!in_array($userRole, $roles)) {
            abort(403, 'Bạn không có quyền truy cập.');
        }

        return $next($request);
    }
}