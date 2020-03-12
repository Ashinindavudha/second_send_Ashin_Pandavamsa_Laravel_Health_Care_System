@extends('layouts.admin')
@section('content')
@can('treatment_create')
<div style="margin-bottom: 10px;" class="row">
  <div class="col-lg-12">
    <!-- <a class="btn btn-success" href="{{ route('histories.create') }}">
      {{ trans('global.add') }} {{ trans('cruds.treatment.title_singular') }}
    </a> -->
  </div>
</div>
@endcan
<div class="card">
  <div class="card-header card-header-primary">
    <h4 class="card-title">
      {{ trans('cruds.treatment.fields.use') }} {{ trans('global.list') }}
    </h4>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-hover datatable datatable-Role">
        <thead>
          <tr>
            <th width="10">

            </th>
            <th>
              {{ trans('cruds.treatment.fields.id') }}
            </th>
            
            <th>
              {{ trans('cruds.treatment.fields.use') }}
            </th>
            <th>
              {{ trans('cruds.treatment.fields.use_day') }}
            </th>
            <th>
              &nbsp;
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach($treatments as $key => $treatment)
          <tr data-entry-id="{{ $treatment->id }}">
            <td>

            </td>
            <td>
              {{ $treatment->id ?? '' }}
            </td>
            <td>
              @foreach($treatment->medicines as $key => $item)
              <span class="badge badge-info">{{ $item->name }}</span>
              @endforeach
            </td>
            <td>
              {{ $treatment->created_at ?? '' }}
            </td>
            <td>
              @can('treatment_show')
              <a class="btn btn-xs btn-primary" href="{{ route('histories.show', $treatment->id) }}">
                {{ trans('global.view') }}
              </a>
              @endcan
            </td>

          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
@section('scripts')
@parent
<script>
  $(function () {
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    @can('role_delete')
    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
    let deleteButton = {
      text: deleteButtonTrans,
      url: "{{ route('admin.roles.massDestroy') }}",
      className: 'btn-danger',
      action: function (e, dt, node, config) {
        var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
        });

        if (ids.length === 0) {
          alert('{{ trans('global.datatables.zero_selected') }}')

          return
        }

        if (confirm('{{ trans('global.areYouSure') }}')) {
          $.ajax({
            headers: {'x-csrf-token': _token},
            method: 'POST',
            url: config.url,
            data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
        }
      }
    }
    dtButtons.push(deleteButton)
    @endcan

    $.extend(true, $.fn.dataTable.defaults, {
      order: [[ 1, 'desc' ]],
      pageLength: 100,
    });
    $('.datatable-Role:not(.ajaxTable)').DataTable(
      { buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
      .columns.adjust();
    });
  })

</script>
@endsection
