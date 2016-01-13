<style>
    .row.well {
        margin-left: 0px;
        margin-right:0px;
    }

</style>



<h1 class="page-header"> {{ $plant->common_name }} </h1>

<div>
    <h2>Common Name:</h2>
    {{ $plant->common_name }}
</div>

<div>
    <h2>Botanical Name:</h2>
    {{ $plant->botanical_name }}
</div>

<div>
    <h2>Creation Date:</h2>
    {{ $plant->created_at }}
</div>

<div>
    <h2>Categories:</h2>
    <ul>
        @foreach($plant->categories as $category)
            <li> {{ $category->category }}</li>
        @endforeach
    </ul>
</div>


<div>
    <h2>Subcategories:</h2>
    <ul>
        @foreach($plant->subcategories as $subcategory)
            <li> {{ $subcategory->subcategory }}</li>
        @endforeach
    </ul>
</div>

<div>
    <h2>Searchable Names:</h2>
    <ul>
        @foreach($plant->searchablenames as $searchablename)
            <li> {{ $searchablename->name }}</li>
        @endforeach
    </ul>
</div>

<div>
    <h2>Zone:</h2>
    <ul>
        {{ $plant->zone->zone }}
    </ul>
</div>

<div>
    <h2>Tolerates:</h2>
    <ul>
        @foreach($plant->tolerations as $toleration)
            <li> {{ $toleration->toleration }}</li>
        @endforeach
    </ul>
</div>

<div>
    <h2>Negative Characteristics:</h2>
    <ul>
        @foreach($plant->negativetraits as $negativetraits)
            <li> {{ $negativetraits->characteristic }}</li>
        @endforeach
    </ul>
</div>

<div>
    <h2>Positive Characteristics:</h2>
    <ul>
        @foreach($plant->positivetraits as $positivetraits)
            <li> {{ $positivetraits->characteristic }}</li>
        @endforeach
    </ul>
</div>

<div>
    <h2>Growth Rate:</h2>
    {{ $plant->growthrate->type }}
</div>

<div>
    <h2>Average Size:</h2>
    {{ $plant->averagesize->size }}
</div>

<div>
    <h2>Maintenance:</h2>
    {{ $plant->maintenance->maintenance }}
</div>

<div>
    <h2>Sun:</h2>
    {{ $plant->sunexposure->exposure }}
</div>

<div>
    <h2>Moisture:</h2>
    {{ $plant->moisture . "%" }}
</div>


<div>
    <h2>Soil</h2>
    <ul>
        @foreach($plant->soils as $soil)
            <li> {{ $soil->soil_type }}</li>
        @endforeach
    </ul>
</div>

<div>
    <h2>Description</h2>
    {{ $plant->description }}
</div>

<div>
    <h2>Important Notes</h2>
    {{ $plant->notes }}
</div>

<div>
    <h2>Main Image</h2>
    {{ $plant->main_image['path'] . ".png" }} <span> {{$plant->main_image['description'] }} </span> <span> {{$plant->main_image['photo-credit'] }} </span>
</div>

<div>
    <h2>Sponsor</h2>
    <p>Name: {{ $plant->sponsor['sponsor'] }}</p>
    <p>Site: {{ $plant->sponsor['url'] }}</p>
    <p>Email: {{ $plant->sponsor['email'] }}</p>
    <p>Description: {{ $plant->sponsor['description'] }}</p>
    <p>Active From: {{ $plant->sponsor['active_from'] }}</p>
    <p>Active To: {{ $plant->sponsor['active_to'] }}</p>
</div>