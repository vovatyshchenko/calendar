@if($emailMessage['type']=='birthday')
    <div>Напоминание о Дне Рождении</div>
    <div>Название :{{$emailMessage['name']}}</div>
    <div>Дата:{{ $emailMessage['date']}}</div>
@else
    <div>Напоминание о задаче</div>
    <div>Название :{{$emailMessage['name']}}</div>
    <div>Описание :{{$emailMessage['description']??'-'}}</div>
    <div>Дата начала:{{ $emailMessage['date_start']}},{{ $emailMessage['time_start']}}</div>
    <div>Дата окончания:{{ $emailMessage['date_end']}},{{ $emailMessage['time_end']}}</div>
@endif

