<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class StudyInfoPageForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title', 'text')
            ->add('body', 'textarea')
            ->add('submit', 'submit');
    }
}
