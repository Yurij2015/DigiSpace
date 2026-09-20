<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Pages saved by the legacy admin contain relative image paths like
     * src="../../uploads/widgets/…". Under the {locale} route prefix those
     * resolve to /{locale}/uploads/… and 404; normalize them to root-absolute
     * /uploads/… which works from any depth.
     */
    public function up(): void
    {
        DB::table('pages')
            ->where('content', 'like', '%../../uploads/%')
            ->update(['content' => DB::raw("REPLACE(content, '../../uploads/', '/uploads/')")]);

        DB::table('pages')
            ->where('content', 'like', '%"../uploads/%')
            ->update(['content' => DB::raw("REPLACE(content, '\"../uploads/', '\"/uploads/')")]);
    }
};
