<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSoftDeletesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //マイグレーションファイルで「$table->softDeletes();」を追加することでdeleted_atカラムを作成することができます。
            $table->softDeletes();
            //削除したユーザのメールアドレスはUNIQUE制約で再登録できない
            //emailとdeleted_atの２つのカラムでUNIQUE制約を設定
            //emailのユニークキーを削除
            $table->dropUnique('users_email_unique');//個別？
            $table->unique(['email', 'deleted_at'], 'users_email_unique');//セット名？

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
            //SoftDeletesを削除='deleted_at'カラム削除
            $table->dropColumn('deleted_at');
            //emailのユニークキーを復活
            $table->unique('email','users_email_unique');//個別？
            $table->dropUnique('users_email_unique');//セット名？

        });
    }
}
