<link href="/css/prism.css" rel="stylesheet" />

@if(isset($article))
    {!! Form::model($article, ['route' => ['admin.articles.update', $article->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['route' => ['admin.articles.store'], 'class' => 'form-horizontal']) !!}
@endif
<form class="form-horizontal">
    @if(isset($article))
        <div class="form-group">
            {!! Form::label('id', 'Id', array('class' => 'control-label col-md-1 col-sm-1 col-xs-12')); !!}
            <div class="col-md-3 col-sm-3 col-xs-12">
                {!! Form::text('id', null, ['name' => '', 'readonly' => 'readonly', 'class' => 'form-control col-md-7 col-xs-12']) !!} 
            </div>
        </div>
    @endif
    <div class="form-group">
        {!! Html::decode(
            Form::label('title', 'Title<span class="required">*</span>', array('class' => 'control-label col-md-1 col-sm-1 col-xs-12'))
        ) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('title', null, ['required' => 'required', 'class' => 'form-control col-md-7 col-xs-12']) !!}             
        </div>
    </div>
    <div class="form-group">
        {!! Html::decode(
            Form::label('description', 'Description<span class="required">*</span>', array('class' => 'control-label col-md-1 col-sm-1 col-xs-12'))
        ) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::textarea('description', null, ['required' => 'required', 'class' => 'form-control col-md-7 col-xs-12', 'rows' => '2']) !!}   
            <!-- <textarea id="description" required="required" class="form-control col-md-7 col-xs-12" data-parsley-validation-threshold="10" data-parsley-minlength-message="The description is too short" data-parsley-maxlength="155" data-parsley-minlength="20" data-parsley-trigger="keyup" name="description" required="required" data-parsley-id="9972"></textarea> -->
        </div>
    </div>
    <div class="form-group">
        {!! Html::decode(
            Form::label('slug', 'Slug<span class="required">*</span>', array('class' => 'control-label col-md-1 col-sm-1 col-xs-12'))
        ) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('slug', null, ['required' => 'required', 'class' => 'form-control col-md-7 col-xs-12']) !!}
        </div>
    </div>    
    <div class="form-group">
        {!! Html::decode(
            Form::label('keywords', 'Keywords<span class="required">*</span>', array('class' => 'control-label col-md-1 col-sm-1 col-xs-12'))
        ) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('keywords', null, ['required' => 'required', 'class' => 'form-control col-md-7 col-xs-12']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Html::decode(
            Form::label('categoriesString', 'Categories<span class="required">*</span>', array('class' => 'control-label col-md-1 col-sm-1 col-xs-12'))
        ) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('categoriesString', null, ['required' => 'required', 'class' => 'form-control col-md-7 col-xs-12']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('author_id', 'Author', array('class' => 'control-label col-md-1 col-sm-1 col-xs-12')) !!}
        <div class="col-md-3 col-sm-3 col-xs-12">
                {!! Form::select('author_id', $users, null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Html::decode(
            Form::label('content', 'Content<span class="required">*</span>', array('class' => 'control-label col-md-1 col-sm-1 col-xs-12'))
        ) !!}
        <div class="col-md-9 col-sm-9 col-xs-12">
            {!! Form::textarea('content', null, ['required' => 'required', 'class' => 'form-control col-md-7 col-xs-12', 'rows' => '10', 'cols' => '80']) !!} 
        </div>
    </div>
    <script>
        CKEDITOR.replace( 'content' );
    </script>    
    <div class="form-group">
        {!! Html::decode(
            Form::label('photo_path', 'Cover photo<span class="required">*</span>', array('class' => 'control-label col-md-1 col-sm-1 col-xs-12'))
        ) !!}
        <div class="col-md-4 col-sm-4 col-xs-12">
            {!! Form::text('photo_path', null, ['required' => 'required', 'class' => 'form-control col-md-4 col-xs-12']) !!}
        </div>
        <a role="button" class="btn btn-primary image-filemanager">Launch file manager</a>
    </div>
                    
    <div class="form-group">
        {!! Form::label('published', 'Published', array('class' => 'control-label col-md-1 col-sm-1 col-xs-12')) !!}
        <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="checkbox">
                <label style="padding-left: 0">
                    {!! Form::checkbox('is_published', '1', null, ['class' => 'flat']); !!}                    
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Html::decode(
            Form::label('published_at', 'Published at<span class="required">*</span>', array('class' => 'control-label col-md-1 col-sm-1 col-xs-12'))
        ) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::date('published_at', null, ['required' => 'required', 'class' => 'form-control col-md-7 col-xs-12']) !!}
        </div>
    </div>
    @if(isset($article))
        <div class="form-group">
            {!! Form::label('views_count', 'Views count', array('class' => 'control-label col-md-1 col-sm-1 col-xs-12')) !!}
            <div class="col-md-3 col-sm-3 col-xs-12">
                {!! Form::text('views_count', null, ['class' => 'form-control col-md-7 col-xs-12', 'readonly' => 'readonly']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('created_at', 'Created', array('class' => 'control-label col-md-1 col-sm-1 col-xs-12')) !!}
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::date('created_at', null, ['class' => 'form-control col-md-7 col-xs-12', 'readonly' => 'readonly']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('updated_at', 'Last Updated', array('class' => 'control-label col-md-1 col-sm-1 col-xs-12')) !!}
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::date('updated_at', null, ['class' => 'form-control col-md-7 col-xs-12', 'readonly' => 'readonly']) !!}
            </div>
        </div>
    @endif
    <br>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <a href="{{ isset($backUrl) ? $backUrl : route('admin.articles.index') }}" class="btn btn-primary">Cancel</a>
            {!! Form::submit('Save', ['class' => 'btn btn-success']); !!}
            @if(isset($article))
                <a href="{{ route('articles.show', $article->slug) }}" target="_blank" class="btn btn-info col-md-offset-1">Go to article page</a></div>
            @endif
        </div>
    </div>
{!! Form::close() !!}

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="/js/prism.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#published_at').datepicker({
                dateFormat: "dd/mm/yy",
                orientation: "top left",
                todayHighlight: true
        });

        $('.image-filemanager').click(function (event) {
            event.preventDefault();
            var win_h = $(window).height() * 0.9;
            var win_w = $(window).width() * 0.95;

            var left = (screen.width/2) + ((screen.width - $(window).width())/2)-(win_w/2);
            var top = (screen.height/2) + ((screen.height - $(window).height())/2)-(win_h/2);
            window.open("{{ route('admin.filemanager.images.index') }}", "popupWindow", "width=" + win_w + ", height=" + win_h + ", top="+top+", left="+ left +", scrollbars=yes");
        });

        var availableCategories = [
        @foreach($categories as $category)
          "{{ $category->name }}",
        @endforeach
        ];
        function split( val ) {
          return val.split( /,\s*/ );
        }
        function extractLast( term ) {
          return split( term ).pop();
        }
 
        $( "#categoriesString" )
          // don't navigate away from the field on tab when selecting an item
          .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
              event.preventDefault();
            }
          })
          .autocomplete({
            minLength: 0,
            source: function( request, response ) {
              // delegate back to autocomplete, but extract the last term
              response( $.ui.autocomplete.filter(
                availableCategories, extractLast( request.term ) ) );
            },
            focus: function() {
              // prevent value inserted on focus
              return false;
            },
            select: function( event, ui ) {
              var terms = split( this.value );
              // remove the current input
              terms.pop();
              // add the selected item
              terms.push( ui.item.value );
              // add placeholder to get the comma-and-space at the end
              terms.push( "" );
              this.value = terms.join( ", " );
              return false;
            }
          });
    });
</script>