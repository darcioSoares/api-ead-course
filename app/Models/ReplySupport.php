<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplySupport extends Model
{
    use HasFactory;

    protected $table = 'reply_support';
    protected $fillable = ['description', 'support_id','user_id'];

    //eu passo um metodo de relacionamento / sera alterando o timestamp referente a esse relacionamento
    // protected $touches = ['support'];

    public function support()
    {
        return $this->belongsTo(Support::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
