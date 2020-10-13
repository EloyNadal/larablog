<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailWelcomeUser
{
    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {

        $data['title'] = "Bienvenido ". $event->user->name;

        //si el use no funciona, añadir varible privada de event y acceder con $this->event
        Mail::send('Html.view', $data, function ($message) use ($event){
            $message->to($event->user->email, $event->user->name);
            $message->subject('Gracias por registrarte'. $event->user->name);
        });
    }
}
