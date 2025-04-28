<?php 

class SingerEvents {

    use Controller;
    use Model;

    public function index()
    {
        $event = new Event;
        $note = new Note;
        $data = [];

        $data = $this->getFutureCollaboratorEvents($event);
        // show($data);
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_note'])) {
            
            $event_id = $_POST['event_id'] ?? null;
            $noteText = trim($_POST['noteText'] ?? '');

            if ($event_id && !empty($noteText)) {
                $user_id = $_SESSION['USER']->id;

                // Fetch existing note safely
                $existingNote = $note->first([
                    'event_id' => $event_id,
                    'user_id' => $user_id,
                ]);

                if ($existingNote && isset($existingNote->id)) {
                    // Update existing note
                    $note->update($existingNote->id, [
                        'note' => $noteText,
                    ]);
                    redirect('colloborator-events');
                } else {
                    // Insert new note
                    $note->insert([
                        'event_id' => $event_id,
                        'user_id' => $user_id,
                        'note' => $noteText,
                    ]);
                    redirect('colloborator-events');
                }
            }
        }
        
        $this->view('eventCollaborator/singerFutureevents',$data);

    }

    public function getFutureCollaboratorEvents($event)
{
    $user_id = $_SESSION['USER']->id;

    // Fetch events
    $events = $event->getFutureEventsInfoForCollaborators($user_id);

    // Fetch notes for each event and add them to the event data
    foreach ($events as $key => $eventItem) {
        // Get the note for this event
        $note = $this->getNote($eventItem->id, $user_id);

        // Add note to the event
        $events[$key]->note = $note ? $note->note : ''; // If no note exists, set an empty string
    }

    return $events;
}

    public function getNote($event_id, $user_id)
    {
        $note = new Note;
        $result = $note->first(['event_id' => $event_id, 'user_id' => $user_id]);
        return $result;
    }
   
}