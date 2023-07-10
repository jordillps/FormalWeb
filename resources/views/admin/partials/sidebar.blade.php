<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin') }}" class="brand-link">
      <img src="{{ asset('img/admin/logoFormalWeb.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <div class="brand-text font-weight-light">Formal Web</div>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if(count(Auth::user()->getMedia('images'))>0)
            <img src="{{ Auth::user()->getMedia('images')[0]->getUrl() }}" class="img-circle elevation-2" alt="User Image"></td>
          @else
            <img src="{{ asset('img/admin/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
          @endif
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

     @if(Auth::user()->isAdmin())
        <!-- Sidebar Menu -->
        <nav class="mt-2" style="border-bottom: 1px solid #4f5962;">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-header">{{ __('global.items') }}</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  {{ __('global.about') }}
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item ml-5">
                  <a href="{{ route('abouts.index') }}" class="nav-link">
                    <p>{{ __('global.list') }}</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  {{ __('global.posts') }}
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item ml-5">
                  <a href="{{ route('posts.index') }}" class="nav-link">
                    <p>{{ __('global.list') }}</p>
                  </a>
                </li>
                <li class="nav-item ml-5">
                  <a href="{{ route('posts.create') }}" class="nav-link">
                    <p>{{ __('global.create') }}</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-project-diagram"></i>
                <p>
                  {{ __('global.projects') }}
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item ml-5">
                  <a href="{{ route('projects.index') }}" class="nav-link">
                    <p>{{ __('global.list') }}</p>
                  </a>
                </li>
                <li class="nav-item ml-5">
                  <a href="{{ route('projects.create') }}" class="nav-link">
                    <p>{{ __('global.create') }}</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  {{ __('global.pages') }}
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item ml-5">
                  <a href="{{ route('pages.index') }}" class="nav-link">
                    <p>{{ __('global.list') }}</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  {{ __('global.legal-pages') }}
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item ml-5">
                  <a href="{{ route('legal-pages.index') }}" class="nav-link">
                    <p>{{ __('global.list') }}</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tasks"></i>
                <p>
                  {{ __('global.services') }}
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item ml-5">
                  <a href="{{ route('services.index') }}" class="nav-link">
                    <p>{{ __('global.list') }}</p>
                  </a>
                </li>
                <li class="nav-item ml-5">
                  <a href="{{ route('services.create') }}" class="nav-link">
                    <p>{{ __('global.create') }}</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-columns"></i>
                <p>
                  {{ __('global.page-components') }}
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      {{ __('global.headers') }}
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item ml-5">
                      <a href="{{ route('headers.index') }}" class="nav-link">
                        <p>{{ __('global.list') }}</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      {{ __('global.titles') }}
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item ml-5">
                      <a href="{{ route('titles.index') }}" class="nav-link">
                        <p>{{ __('global.list') }}</p>
                      </a>
                    </li>
                    <li class="nav-item ml-5">
                      <a href="{{ route('titles.create') }}" class="nav-link">
                        <p>{{ __('global.create') }}</p>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-phone"></i>
                <p>
                  {{ __('global.contacts') }}
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item ml-5">
                  <a href="{{ route('contacts-list.index') }}" class="nav-link">
                    <p>{{ __('global.list') }}</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  {{ __('global.categories') }}
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item ml-5">
                  <a href="{{ route('categories.index') }}" class="nav-link">
                    <p>{{ __('global.list') }}</p>
                  </a>
                </li>
                <li class="nav-item ml-5">
                  <a href="{{ route('categories.create') }}" class="nav-link">
                    <p>{{ __('global.create') }}</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item" stlye="margin-bottom: 1px solid #c2c7d0">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tags"></i>
                <p>
                  {{ __('global.tags') }}
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item ml-5">
                  <a href="{{ route('tags.index') }}" class="nav-link">
                    <p>{{ __('global.list') }}</p>
                  </a>
                </li>
                <li class="nav-item ml-5">
                  <a href="{{ route('tags.create') }}" class="nav-link">
                    <p>{{ __('global.create') }}</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users-cog"></i>
                <p>
                  {{ __('global.users') }}
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item ml-5">
                  <a href="{{ route('users.index') }}" class="nav-link">
                    <p>{{ __('global.list') }}</p>
                  </a>
                </li>
                <li class="nav-item ml-5">
                  <a href="{{ route('users.create') }}" class="nav-link">
                    <p>{{ __('global.create') }}</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                  {{ __('global.settings') }}
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item ml-5">
                  <a href="{{ route('settings.index') }}" class="nav-link">
                    <p>{{ __('global.list') }}</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      @endif
    </div>
    <!-- /.sidebar -->
  </aside>