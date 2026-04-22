@props(['division'])

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach ($division->staffs as $member)
        <x-molecules.cards.member-card :name="$member->name" :position="$member->position" size="normal" :dept="strtoupper(substr($division->slug ?: $division->name, 0, 6))"
            :href="'/detail-member?staff=' . $member->id" :image="$member->photo ?: asset('images/placeholders/member.svg')" />
    @endforeach
</div>
