<div class="row">
    <!-- separator between navigation and project head -->
    <br>
</div>
<div class="row">
    <div class="col-12">
        <h4>This page provides space to record notes / comments</h4>
    </div>
    <div class="col-12">
        <h5>New note</h5>
        <form action="{{ route('note.post') }}" method="POST">
            @csrf
            <div class="row center">
                <div class="col-12">
                    <label for="note">Note</label>
                    <input type="text" id="name" name="note" class="form-control">
                </div>
                <div class="col-12">
                    <label for="note">Comment</label>
                    <input type="text" id="name" name="comment" class="form-control">
                </div>
                <div class="col-12">
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-12" style="margin-top: 50px">
        <table class="table table-sm">
            <tr>
                <th></th>
                <th>Notes</th>
                <th>Comments</th>
            </tr>
            @foreach($project->notes as $note)
            <tr>
                <td><a onclick="deleteNote({{ $note->id }})"><i class="icon-fa icon-fa-trash"/></a></td>
                <td width="60%" style="font-size: 1rem;">{{ $note->note }}</td>
                <td style="font-size: 1rem;">{{ $note->comment }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>