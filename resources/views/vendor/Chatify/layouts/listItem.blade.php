{{-- -------------------- Saved Messages -------------------- --}}
@if ($get == 'saved')
    <table class="messenger-list-item" data-contact="{{ Auth::user()->id }}">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td>
                <div class="saved-messages avatar av-m">
                    <span class="far fa-bookmark"></span>
                </div>
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ Auth::user()->id }}" data-type="user" class="position-relative">
                    {{__('Saved Messages')}}
                    <span class="position-absolute top-0 end-0">{{__('You')}}</span>
                </p>
                <span>{{__('Save messages secretly')}}  </span>
            </td>
        </tr>
    </table>
@endif

{{-- -------------------- Contact list -------------------- --}}
@if ($get == 'users')
    {{-- @dd($get) --}}
    @if (!!$lastMessage)
        <?php
        $lastMessageBody = mb_convert_encoding($lastMessage->body, 'UTF-8', 'UTF-8');
        $lastMessageBody = strlen($lastMessageBody) > 30 ? mb_substr($lastMessageBody, 0, 30, 'UTF-8') . '..' : $lastMessageBody;
        ?>
    @endif
    <table class="messenger-list-item" data-contact="{{ $user->id }}">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td style="position: relative">
                @if ($user->active_status)
                    <span class="activeStatus"></span>
                @endif
                @if (pathinfo($user->avatar, PATHINFO_EXTENSION) !== '')
                    <div class="avatar av-m" style="background-image: url('{{ asset($user->avatar) }}');">
                    </div>
                @else
                    <div class="avatar av-m" style="background-image: url('{{ asset('assets/imgs/avatar.png') }}');">
                    </div>
                @endif
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ $user->id }}" data-type="user" class="position-relative">
                    {{ strlen($user->name) > 12 ? trim(substr($user->name, 0, 12)) . '..' : $user->name }}
                    <span class="contact-item-time position-absolute top-0 end-0"
                        data-time="{{ $lastMessage->created_at ?? '' }}">{{ $lastMessage->timeAgo ?? '' }}</span>
                </p>
                @if ($lastMessage)
                    <span>
                        {{-- Last Message user indicator --}}
                        {!! $lastMessage->from_id == Auth::user()->id ? '<span class="lastMessageIndicator">' . __('You') . ' : </span>' : '' !!}
                        {{-- Last message body --}}
                        @if ($lastMessage->attachment == null)
                            {!! $lastMessageBody !!}
                        @else
                            <span class="fas fa-file"></span> {{__('Attachment')}}
                        @endif
                    </span>
                    {{-- New messages counter --}}
                    {!! $unseenCounter > 0 ? '<b>' . $unseenCounter . '</b>' : '' !!}
                @endif
            </td>
        </tr>
    </table>
@endif

{{-- -------------------- Search Item -------------------- --}}
@if ($get == 'search_item')
    <table class="messenger-list-item" data-contact="{{ $user->id }}">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td>
                @if (pathinfo($user->avatar, PATHINFO_EXTENSION) !== '')
                    <div class="avatar av-m" style="background-image: url('{{ asset($user->avatar) }}');">
                    </div>
                @else
                    <div class="avatar av-m" style="background-image: url('{{ asset('assets/imgs/avatar.png') }}');">
                    </div>
                @endif
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ $user->id }}" data-type="user">
                    {{ strlen($user->name) > 12 ? trim(substr($user->name, 0, 12)) . '..' : $user->name }}
            </td>

        </tr>
    </table>
@endif

{{-- -------------------- Shared photos Item -------------------- --}}
@if ($get == 'sharedPhoto')

    <div class="shared-photo chat-image" style="background-image: url('{{ $image }}')"></div>
@endif
