@canany(collect(config('novamanufacture.resources'))->map(function ($resource) { return 'viewAny ' . $resource::urikey(); }))
    <nova-sidebar>
        <template>
            <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="var(--sidebar-icon)" d="M3 1h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2H3c-1.1045695 0-2-.8954305-2-2V3c0-1.1045695.8954305-2 2-2zm0 2v4h4V3H3zm10-2h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2h-4c-1.1045695 0-2-.8954305-2-2V3c0-1.1045695.8954305-2 2-2zm0 2v4h4V3h-4zM3 11h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2H3c-1.1045695 0-2-.8954305-2-2v-4c0-1.1045695.8954305-2 2-2zm0 2v4h4v-4H3zm10-2h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2h-4c-1.1045695 0-2-.8954305-2-2v-4c0-1.1045695.8954305-2 2-2zm0 2v4h4v-4h-4z"/></svg>
            <span class="sidebar-label">
                {{ __('Manufacture') }}
            </span>
        </template>

        <template v-slot:menu>
            @foreach( config('novamanufacture.resources') as $resource )
                @can( 'viewAny ' . $resource::uriKey() )
                    <li class="leading-wide mb-4 text-sm">
                        <router-link
                            :to="{
                                name: 'index',
                                params: {
                                resourceName: '{{ $resource::uriKey() }}'
                                },
                                }"
                            class="text-white ml-8 no-underline dim"
                        >
                            {{ __($resource::label())  }}
                        </router-link>
                    </li>
                @endcan
            @endforeach
        </template>
    </nova-sidebar>
@endcanany
