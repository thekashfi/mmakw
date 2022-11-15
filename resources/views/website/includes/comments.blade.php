@foreach($comments as $comment)

    <li>
    <div class="avatar">
        <img src="{{ $comment->gravatar }}" alt="" /></div>
    <div class="comment-info">
        <span class="c_name">{{ $comment->name }}</span>
        <span class="c_date id-color">{{ $comment->created_at->format('j F Y') }}</span>
        <span class="c_reply">
            <span onclick="replyTo({{ $comment->id }})" style="cursor:pointer">Reply</span>
        </span>
        <div class="clearfix"></div>
    </div>

    <div class="comment">{!! nl2br(strip_tags($comment->text)) !!}</div>
        @if($comment->childComments->count() > 0 )
        <ol>
        @include('website.includes.comments' , ['comments' => $comment->childComments] )
        </ol>
    @endif
    </li>
@endforeach

<script>
    function replyTo(parent_id) {
        document.getElementById("comment-form-wrapper").scrollIntoView();
        let form = document.getElementById("contact_form");
        let input = document.createElement('input');
        input.setAttribute('type', 'hidden');
        input.setAttribute('name', 'parent_id');
        input.setAttribute('value', parent_id);
        form.appendChild(input);
    }
</script>