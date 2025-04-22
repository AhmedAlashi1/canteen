<div class="dropdown">
    <button class="btn btn-block dropdown-toggle rounded-pill shadow-sm"
            type="button"
            id="dropdownMenuButton"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            style="background-color: #21D0ED; color: white;">
        {{__('general.Actions')}}
    </button>
    <ul class="text-center dropdown-menu dropdown-menu-end shadow animated-dropdown" aria-labelledby="dropdownMenuButton">
        <li>
            <a href="{{ route($routeDisplayImages, $id) }}"
               class="dropdown-item d-flex align-items-center"
               title="Work images">
                <i class="bi bi-images me-2"></i>
                <span>{{__('general.Work Images')}}</span>
            </a>
        </li>
        <li>
            <a href="{{ route($routeEdit, $id) }}" class="dropdown-item d-flex align-items-center">
                <i class="bi bi-pencil-fill me-2"></i>
                <span>{{__('general.Edit')}}</span>
            </a>
        </li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <button type="button" class="delete-btn red-btn dropdown-item d-flex align-items-center"
                    data-url="{{ route($routeDelete, $id) }}"
                    data-name="{{ $name }}">
                <i class="bi bi-trash-fill me-2"></i>
                <span>{{__('general.Delete')}}</span>
            </button>
        </li>
    </ul>
</div>
