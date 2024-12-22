<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class EmailSettings extends Model
{
    use HasUuids;

    protected $fillable = ['form_id', 'send_email', 'send_to', 'subject', 'email_form_filler', 'form_filler_email', 'reply_to', 'form_filler_email_subject', 'from_name'];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}