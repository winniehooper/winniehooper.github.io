<table>
    <tr>
        <td width="160" height="160">
            <a href="{{ route('project', $project) }}">
                <img width="160" height="120" src="{{ $project->getImageUrl('small') }}"/>
            </a>
        </td>
        <td width="24" height="160">&nbsp;</td>
        <td>
            <p style="color:#666666;font-family:'Open Sans','Helvetica Neue','Segoe UI',Helvetica,Arial,sans-serif;font-size:16px;font-weight:600;line-height:20px;margin-bottom:15px;margin-left:0;margin-right:0;margin-top:15px;padding-bottom:0;padding-left:0;padding-right:0;padding-top:0;">
                {{ $project->name }}
            </p>
            @component('mail::button', ['url' => route('project', $project)])
            Посмотреть проект
            @endcomponent
        </td>
        <td width="24" height="160">&nbsp;</td>
    </tr>
</table>

