<?php

namespace App\Notifications;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProjectModerate extends BaseNotification
{

    /**
     * @var Project $project ;
     */
    public $project;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
        $this->user_id = $project->user_id;
    }


    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown(
          'mail.project.moderate',
          ['project' => $this->project]
        )->subject('Проект отправлен на модерацию');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
          'project_id'  => $this->project->id,
          'user_id'     => $this->project->user_id,
          'subject'     => 'Проект «'.link_to_route(
              'project',
              $this->project->name,
              [$this->project],
              ['class' => 'nb-link']
            ).'» отправлен на модерацию',
          'icon'        => 'moderate',
          'message'     => 'Отлично! Вы отправили свой проект на модерацию. Менеджер Улья проверит его в течение 3-х рабочих дней. Улей обязательно уведомит вас о результате.',
          'action_url'  => '/study/6',
          'action_text' => 'Подготовьтесь к продвижению проекта!',
        ];
    }
}
