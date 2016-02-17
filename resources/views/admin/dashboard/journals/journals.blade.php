<h1 class="well"> Journals </h1>

<div class="journal-header-search">
    <h2 class="well"> User Journal Entries </h2>
    <input class="pull-right" id="findJournal" placeholder="Search:" type="text">
</div>

<div class="journal-filters row">
    <div class="date-filter col-md-4">
        <div>
            <label>Start Date</label>
            <input class="form-control" id="startDate" type="date" placeholder="Start Date">
        </div>
        <div>
            <label>End Date</label>
            <input class="form-control" id="endDate" type="date">
        </div>
    </div>
    <div class="library-filter col-md-2">
        <label>Choose Library</label>
        <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                All
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a href="#journals/filter/plant-library">Plant Library</a></li>
                <li><a href="#journals/filter/culinary-plant-library">Culinary Plant Library</a></li>
                <li><a href="#journals/filter/procedure-library">Procedure Library</a></li>
                <li><a href="#journals/filter/pest-library">Pest Library</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-1">
    </div>
    <div class="user-filter col-md-2">
        <label>Filter Journal By User</label>
        <input id="journalsByUser" placeholder="User:" type="text">
    </div>
    <div class="col-md-1">
    </div>
    <div class="sort-by col-md-2">
        <label>Sort By</label>
        <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Latest
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a href="#journals/filter/plant-library">Latest</a></li>
                <li><a href="#journals/filter/culinary-plant-library">Oldest</a></li>
                <li><a href="#journals/filter/procedure-library">User Name Ascending</a></li>
                <li><a href="#journals/filter/pest-library">User Name Descending</a></li>
                <li><a href="#journals/filter/pest-library">Unread Only</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="journals-admin-container well">
    @foreach($journals as $journal)
        <div class="row">
            <div class="col-lg-2 journal-thumbnail">
                <img src="http://placehold.it/250x250">
            </div>
            <div class="col-lg-10 journal">

                <div class="journal-meta">
                    <div class="journal-title">
                        <h3>Title: </h3>
                        <p> {{ $journal->title }} </p>
                    </div>
                    <div class="journal-relationships">

                        @if($journal->plant)
                            <p>
                                <spa>Plant:</spa> <a> {{ $journal->plant->common_name }} </a>
                            </p>
                        @endif

                        @if($journal->pest)
                            <p>
                                <spa>Pest:</spa> <a> {{ $journal->pest->common_name }} </a>
                            </p>
                        @endif

                        @if($journal->procedure)
                            <p>
                                <spa>Procedure:</spa> <a> {{ $journal->procedure->name }} </a>
                            </p>
                        @endif

                        @if($journal->alert)
                            <p>
                                <spa>Alert:</spa> <a> {{ $journal->alert->name }} </a>
                            </p>
                        @endif

                    </div>
                    <div>
                        <p>
                            Posted by <a> {{ $journal->user->username }} </a> on {{ $journal->created_at }}
                        </p>
                    </div>
                </div>
                <div class="journal-content">
                    <p>
                        {{ $journal->content }}
                    </p>
                </div>
            </div>
            <div class="journal-actions">
                <a href="#" class="btn btn-warning contact-user">Contact User</a>
                <a href="#" class="btn btn-danger suspend-journal-entry">Suspend Entry</a>
            </div>
        </div>
    @endforeach

        {!! $journals->render() !!}
</div>

<script>
    TypeAhead('#findJournal', 'search/journals', 'journal', 'name', function(suggestion){

    });

    TypeAhead('#journalsByUser', 'search/journals/users', 'users', 'name', function(suggestion){

    });

</script>