<h3>Ticket Created Successfully</h3>

<p>Your ticket has been created and will be valid till {{ $ticket->created_at->clone()->addHours(1)->format('d-m-Y h:i') }}</p>