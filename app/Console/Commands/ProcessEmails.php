<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SuccessfulEmail;

class ProcessEmails extends Command
{
    protected $signature = 'emails:process';
    protected $description = 'Processa os e-mails e extrai o texto simples';

    public function handle()
    {
        $emails = SuccessfulEmail::whereNull('raw_text')->get();

        foreach ($emails as $email) {
            $rawText = $this->extractPlainText($email->email);
            $email->raw_text = $rawText;
            $email->save();
        }

        $this->info('E-mails processados com sucesso.');
    }

    private function extractPlainText($rawEmail)
    {
        // Aqui você pode usar uma biblioteca como \PhpMimeMailParser\Parser
        $parser = new \PhpMimeMailParser\Parser();
        $parser->setText($rawEmail);

        return $parser->getMessageBody('text');
    }
}

