<nav class="sidebar">
  <div class="sidebar-header">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
      KING<span>UI</span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item nav-category">Role</li>
      <li class="nav-item @if(Request::segment(2) == 'users') active @endif">
        <a href="{{ route('admin.users') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Users</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.color') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Color</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('admin/product_cart') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Product Cart</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('admin/order') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Order</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('admin/blog') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Blog</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('admin/send_pdf') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Send PDF</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('admin/transactions') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Transactions</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('admin/full_calendar') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Full Calendar</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('admin/change_password') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Change Password</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('admin/discount_code') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Discount Code</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('admin/support') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Support</span>
        </a>
      </li>

      <li class="nav-item nav-category">User Week</li>
      <li class="nav-item @if(Request::segment(2) == 'week') active @endif">
        <a href="{{ url('admin/week') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Week</span>
        </a>
      </li>
      <li class="nav-item @if(Request::segment(2) == 'week_time') active @endif">
        <a href="{{ url('admin/week_time') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Week Time</span>
        </a>
      </li>
      <li class="nav-item @if(Request::segment(2) == 'schedule') active @endif">
        <a href="{{ url('admin/schedule') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Schedule</span>
        </a>
      </li>

      <li class="nav-item nav-category">Address</li>
      <li class="nav-item">
        <a href="{{ url('admin/countries') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Countries</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('admin/state') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">State</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('admin/city') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">City</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('admin/address') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Address</span>
        </a>
      </li>

      <li class="nav-item nav-category">Notification</li>
      <li class="nav-item @if(Request::segment(2) == 'notification') active @endif">
        <a href="{{ url('admin/notification') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Push Notification</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('admin/qrcode') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">QRCode</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('admin/smtp') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">SMTP</span>
        </a>
      </li>

      <li class="nav-item nav-category">web apps</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
          <i class="link-icon" data-feather="mail"></i>
          <span class="link-title">Email</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="emails">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('admin/email/compose') }}" class="nav-link">Compose</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.email.sent') }}" class="nav-link">보낸 메일</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a href="pages/apps/calendar.html" class="nav-link">
          <i class="link-icon" data-feather="calendar"></i>
          <span class="link-title">Calendar</span>
        </a>
      </li>
      <li class="nav-item nav-category">Components</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false" aria-controls="uiComponents">
          <i class="link-icon" data-feather="feather"></i>
          <span class="link-title">UI Kit</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="uiComponents">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="pages/ui-components/accordion.html" class="nav-link">Accordion</a>
            </li>
            <li class="nav-item">
              <a href="pages/ui-components/alerts.html" class="nav-link">Alerts</a>
            </li>
          </ul>
        </div>
      </li>
      
      <li class="nav-item nav-category">Docs</li>
      <li class="nav-item">
        <a href="#" target="_blank" class="nav-link">
          <i class="link-icon" data-feather="hash"></i>
          <span class="link-title">Documentation</span>
        </a>
      </li>
    </ul>
  </div>
</nav>
