<x-dashboard.index title="Users">
    <div class="inline-block min-w-full rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead class="sticky top-0">
                <tr>
                    <th class="px-5 py-4 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        User
                    </th>
                    <th class="px-5 py-4 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Role
                    </th>
                    <th class="px-5 py-4 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Created at
                    </th>
                    <th class="px-5 py-4 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody class="overflow-y-auto">
            @foreach($users as $user)
                <tr>
                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                        <div class="flex items-center">
                            <div class="inline-flex flex-shrink-0 w-10 h-10 rounded-full bg-gray-100 border border-gray-200 items-center justify-center">
                                @if(empty($user->image))
                                    <i class="fa-duotone fa-solid fa-user text-gray-400"></i>
                                @else
                                    <img class="w-full h-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2.2&amp;w=160&amp;h=160&amp;q=80" alt="">
                                @endif
                            </div>
                            <div class="ml-3">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $user->name }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-gray-900 whitespace-no-wrap capitalize">{{ $user->role() }}</td>
                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">{{ $user->created_at->diffForHumans() }}</td>
                    <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                        <span class="relative inline-block px-3 py-1 leading-tight">
                            <span aria-hidden="" class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                            <span class="relative">{{ empty($user->status) ? 'N/A' : $user->status }}</span>
                        </span>
                    </td>
                </tr>
            @endforeach
                <!-- Repeat other rows -->
            </tbody>
        </table>
        <!-- Pagination -->
    </div>
</x-dashboard.index>
