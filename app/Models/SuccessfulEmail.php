<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuccessfulEmail extends Model
{
    use HasFactory;

    // Nome da tabela no banco de dados
    protected $table = 'successful_emails';

    // Atributos que são atribuíveis em massa
    protected $fillable = [
        'affiliate_id',
        'envelope',
        'from',
        'subject',
        'dkim',
        'SPF',
        'spam_score',
        'email',
        'raw_text',
        'sender_ip',
        'to',
        'timestamp',
    ];

    // Desabilitando timestamps automáticos (created_at, updated_at)
    public $timestamps = false;

    // Caso queira usar outros nomes para os campos de timestamp
    // const CREATED_AT = 'creation_date';
    // const UPDATED_AT = 'last_update';
}
