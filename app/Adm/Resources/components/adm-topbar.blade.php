@auth()
    <style>
        body {
            padding-top: 40px!important;
        }
        #adm-top-bar {
            padding: 2px 20px;
            height: 30px;
            position: fixed;
            top: 0;
            border-bottom: 1px solid #000;
            width: 100%;
            background: #000;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            color: #fff;
        }

        #adm-top-bar a{
            color: #fff;
        }

        #adm-top-bar input{
            height: 27px;
            padding: 0 10px;
            border-radius: 5px;
        }
    </style>
    <div id="adm-top-bar">
        <div class="adm-top-bar-menu">
            <a href="/admin">Dashboard</a>
            @if($isEditable && auth()->user()->isAdmin())
                | <a href="{{'/admin/'.$pluralTypeName.'/'.$record->id.'/edit'}}">Edit</a>
            @endif
        </div>

        <div class="adm-top-bar-user">
            <form action="/filament/logout" method="post">
                @csrf
              <input type="submit" value="Logout">
            </form>
        </div>
    </div>
@endauth

