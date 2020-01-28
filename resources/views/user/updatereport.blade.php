<html>
    <head>
        <title></title>
    </head>
    <body>
        <form action="/update/{{$report->id}}" method="POST">
            @csrf
            <pre>
            Name           <input type="text" name="name" value="{{$report->name}}">
                <br>
     Age           <input type="text" name="age" value="{{$report->age}}">
                <br>
     Gender        <input type="text" name="gender" value="{{$report->gender}}">
                <br>
     Image         <input type="text" name="image" value="{{$report->image}}">
                <br>
     Type          <input type="text" name="type" value="{{$report->type}}">
                <br>
     Special_mark <input type="text" name="special_mark" value="{{$report->special_mark}}">
                <br>
     Eye_Color    <input type="text" name="eye_color" value="{{$report->eye_color}}">
                <br>
     Hair_Color   <input type="text" name="hair_color" value="{{$report->hair_color}}">
                <br>
     City         <input type="text" name="city"  value="{{$report->city}}">
                <br>
     Region       <input type="text" name="region" value="{{$report->region}}">
                <br>
     Location     <input type="text" name="location" value="{{$report->location}}">
                <br>
     Last_Seen_On <input type="text" name="last_seen_on" value="{{$report->last_seen_on}}">
                <br>
     Last_Seen_At <input type="text" name="last_seen_at"  value="{{$report->last_seen_at}}">
                <br>
     Lost_Since   <input type="text" name="lost_since" value="{{$report->lost_since}}">
                <br>
     Found_Since  <input type="text" name="found_since" value="{{$report->found_since}}">
                <br>
                  <input type="hidden" name="is_found" value="{{$report->is_found}}">
                <br>
     Height       <input type="text" name="height" value="{{$report->height}}">
                <br>
     Weight       <input type="text" name="weight"  value="{{$report->weight}}">
                <br>
            <input type="hidden" name="user_id" value="{{$report->id}}" >
            </pre>
            <input type="submit" name="submit" value="Update">
        </form>
    </body>
</html>