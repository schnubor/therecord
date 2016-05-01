<template id="vinyls-template">
    @if($vinyls->count())
        <div class="vinylControls row">
            <div class="col-md-2">
                <input type="text" class="form-control" placeholder="Filter" v-model="filter">
            </div>
            <div class="col-md-2">
                <select class="form-control" v-model="sorting">
                    <option value="created_at" selected>Latest</option>
                    <option value="artist">Artist</option>
                    <option value="title">Title</option>
                    <option value="label">Label</option>
                    <option value="price">Price</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-control" v-model="itemsPerPage">
                    <option value="16" selected>16 per page</option>
                    <option value="32">32 per page</option>
                    <option value="64">64 per page</option>
                </select>
            </div>
            <nav class="col-md-2">
                <button class="btn btn-default" :class="prevButtonClass" @click="prevPage()"><i class="fa fa-chevron-left"></i></button>
                <ul class="pagination no-margin">
                    <li style="padding: 0 10px;">Page @{{ currentPage + 1 }}</li>
                </ul>
                <button class="btn btn-default" :class="nextButtonClass" @click="nextPage()"><i class="fa fa-chevron-right"></i></button>
            </nav>
        </div>

        <hr>

        <div class="row padding15">
          <div v-for="group in list | filterBy filter in 'artist' 'title' 'label' 'catno' | orderBy sorting | paginate | chunk 4" class="row">
            <div class="col-md-3 vinyl" v-for="vinyl in group">
              <div class="cover">
                <a href="/vinyl/@{{ vinyl.id }}"><img :src="vinyl.artwork" alt="@{{ vinyl.artist }} - @{{ vinyl.title }}"></a>
              </div>
              <div class="info">
                <span class="artist">@{{ vinyl.artist }}</span><br>
                <span class="title">@{{ vinyl.title }}</span>
              </div>
            </div>
          </div>
        </div>
    @else
      <div class="col-md-12 text-center">
        <p class="placeholder">No vinyls in the collection yet.</p>
        @if(Auth::user()->id == $user->id)
          <a href="{{ route('get.search') }}" class="btn btn-primary btn-lg"><i class="fa fa-fw fa-plus"></i> Add vinyl</a>
        @endif
      </div>
    @endif
</template>
