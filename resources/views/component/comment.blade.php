@foreach($listComment as $comment)
<div class="d-flex align-items-start gap-2 my-2 comment-wrapper comment-parent" data-commentid="{{ $comment->id }}">
    <span class="avata @if($comment->account->role != 1) avata-admin @endif">
        @if($comment->account->role == 1)
        {{ $comment->account->first_name[0] }}
        @else
        <img src="{{ url('public/imgs/logo_title.png') }}">
        @endif
    </span>

    <div class="d-flex flex-column w-100">
        <div class="d-flex gap-4">
            <div class="content-wrapper">
                <p class="user-name">{{ $comment->account->last_name }} {{ $comment->account->first_name }}</p>
                <p class="content">{{ $comment->content }}</p>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <i class="fa-solid fa-spinner icon-spinner-item hidden"></i>
            </div>
        </div>


        <div class="content-action d-flex gap-3">
            <a href="#" class="btn-show-reply">Trả lời</a>
            @if($userID == $comment->account->id)
            <a href="#" class="btn-delete">Xóa</a>
            @endif
            <p>Ngày đăng: {{ $comment->created_at->format('d/m/Y H:i:s') }}</p>
        </div>

        <div class="write-comment-reply d-flex justify-content-between align-items-center my-2 hidden">
            <textarea class="write-comment-textarea" placeholder="Phản hồi bình luận..." rows="1"></textarea>
            <button class="btn-send btn-send-row-1 ms-4">Phản hồi</button>
        </div>

        <div class="d-flex justify-content-center">
            <i class="fa-solid fa-spinner icon-spinner-reply hidden"></i>
        </div>

        @foreach($comment->replies as $commentChildlren)
        <div class="d-flex align-items-start gap-2 my-2 comment-wrapper" data-commentid="{{ $commentChildlren->id }}">
            <span class="avata @if($commentChildlren->account->role != 1) avata-admin @endif">
                @if($commentChildlren->account->role == 1)
                {{ $commentChildlren->account->first_name[0] }}
                @else
                <img src="{{ url('public/imgs/logo_title.png') }}">
                @endif
            </span>

            <div class="d-flex flex-column">
                <div class="d-flex gap-4">
                    <div class="content-wrapper">
                        <p class="user-name">{{ $commentChildlren->account->last_name }} {{ $commentChildlren->account->first_name }}</p>
                        <p class="content">{{ $commentChildlren->content }}</p>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fa-solid fa-spinner icon-spinner-item hidden"></i>
                    </div>
                </div>


                <div class="content-action d-flex gap-3">
                    @if($userID == $commentChildlren->account->id)
                    <a href="#" class="btn-delete">Xóa</a>
                    @endif
                    <p>Ngày đăng: {{ $commentChildlren->created_at->format('d/m/Y H:i:s') }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endforeach