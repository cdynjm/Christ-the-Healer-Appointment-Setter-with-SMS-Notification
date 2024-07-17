<select name="time" id="select-time-schedule" class="form-select bg-white" required>
    <option value="">Select Time...</option>
   
    @foreach ($time_slots as $ts)

        <option value="{{ $ts->id }}"
        
        @foreach ($selected_slots as $ss)
            @if($ss->time == $ts->schedule && date('M d, Y', strtotime($ss->date)) == date('M d, Y', strtotime($dateSelected)))
                disabled class="bg-gray-400"
            @endif
        @endforeach
        
        >{{ $ts->schedule }}
    
        @foreach ($selected_slots as $ss)
            @if($ss->time == $ts->schedule && date('M d, Y', strtotime($ss->date)) == date('M d, Y', strtotime($dateSelected)))
                (Scheduled)
            @endif
        @endforeach
        
        </option>
        
    @endforeach
</select>
