<h1>Testing date</h1>
<div>
	<?php
    $notes = DB::table('users')
            ->leftJoin('notifymes','users.id','=','notifymes.user_id')
            ->where('user_id', Auth::user()->id)
            ->get();
    ?>
    <ul>
	    @foreach($notes as $note)
	    <li>
	    <?php $cards = App\Card::where('id', $note->card_id)->get();
	    ?>
	    <p>You have followed 
		    @foreach($cards as $card)
			    <a href="/cards/{{ $note->card_id }}">{{ $card->title}}</a></p>
			    </li>
			    <?php
			    	$dateinput = $card->date_start;	
			    	$datestart = \Carbon\Carbon::createFromFormat( 'Y-m-d' , $dateinput );
			    	echo $datestart->diffInDays(\Carbon\Carbon::now());
			    ?>
			    @if( $datestart->isTomorrow(\Carbon\Carbon::now()))
				    <li>Event {{ $card->title }} starts tomorrow </li>
			    @elseif( $datestart->isToday(\Carbon\Carbon::now()))
			    	<li>Event {{ $card->title }} starts today </li>
			    @else
			    @endif
		    @endforeach
	    @endforeach
    </ul>
</div>