<style>
.card-text {
    word-wrap: break-word;
}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="card shadow-sm">
    <div class="card-body">
        <div class="g-mb-15 d-flex justify-content-between align-items-center">
            <h5 class="h5 g-color-gray-dark-v1 mb-0">{{ $comment->user->name }} 
                @if( $comment->rate < 1.5)
                        <img src="/images/star1.png" style="width:120px;height35px">    
                    @elseif( $comment->rate < 2)  
                        <img src="/images/star1.5.png" style="width:120px;height35px">  
                    @elseif( $comment->rate < 2.5)  
                        <img src="/images/star2.png" style="width:120px;height35px">    
                    @elseif( $comment->rate < 3)   
                        <img src="/images/star2.5.png" style="width:120px;height35px">     
                    @elseif( $comment->rate < 3.5)     
                        <img src="/images/star3.png" style="width:120px;height35px">       
                    @elseif( $comment->rate < 4)  
                        <img src="/images/star3.5.png" style="width:120px;height35px">     
                    @elseif( $comment->rate < 4.5)
                        <img src="/images/star4.png" style="width:120px;height35px">      
                    @elseif( $comment->rate < 5)
                        <img src="/images/star4.5.png" style="width:120px;height35px">      
                    @elseif( $comment->rate = 5)     
                        <img src="/images/star5.png" style="width:120px;height35px">
                @endif
            </h5> 
            <span class="small">{{ $comment->created_at }}</span>
        </div>
        <p class="mt-3 text-overflow-lines">{{ $comment->content }}</p>
    </div>
</div>

