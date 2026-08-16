<!-- Top Navigation -->
<div class="top-nav">
    <div class="search-box">
       
    </div>
    <div class="user-menu">
        <div class="user-profile">
            <div class="profile-img">
                {{ auth()->user()->initials ?? 'AD' }}
            </div>
            <div class="user-info">
                <span>{{ auth()->user()->name ?? 'Admin' }}</span>
            </div>

        </div>
    </div>
</div>