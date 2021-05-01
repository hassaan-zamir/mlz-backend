<?php $location = $ticket->location()->first(); ?>
<h3>Parking Request at {{ $location->name }}</h3>

<p>Parking Permit {{$ticket ->id}} for {{$ticket->license}} has been approved at {{$location->name}}.</p>
<p>Ticket expires at {{ $ticket->created_at->clone()->addHours(1)->format('d-m-Y h:i') }}</p>
<p>For any questions or concerns email <a>parking@mlzsecurity.com</a> or call <b>647-482-0659</b></p>