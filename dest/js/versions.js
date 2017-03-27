var listCount = 3;
$(function () {
  var $table = $('#table');
  var searchText = getUrlParameter('search');
  var queryString = Math.floor(Math.random() * 10000) + 1;

  $.get('./project-metadata.json?r=' + queryString, function( result ) {
    $table.bootstrapTable({
      searchText: searchText,
      columns: [
        {
          valign: 'middle',
          sortable: true
        }
      ],
      data: result.metadata,
      onPostBody: function () {
        $('[data-toggle="tooltip"]').tooltip();
      }
    });
    $('[data-field="updated"]').html($.timeago(result.updated));
  });
});

/**
 * Details formatter.
 *
 * @param index
 * @param row
 * @returns {string}
 */
function detailFormatter(index, row) {
  var html = [];
  $.each(row, function (key, value) {
    if (typeof value == 'object' ) {
      return html.push('<p><u><strong>' + key + '</u></strong></p>' + detailFormatter(key, value));
    }
    html.push('<p><b>' + key + ':</b> ' + value + '</p>');
  });
  return html.join('');
}

/**
 * Provides query param by name.
 *
 * @param name
 * @returns {string}
 */
function getUrlParameter(name) {
  name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
  var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
  var results = regex.exec(location.search);
  return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};

function StatusFormatter(value, row, index) {
  var html = 'Active';
  if (value != 1) {
    html = 'Inactive';
  }
  return html
}

function VersionFormatterUrl(value, row, index) {
  var html = [];
  var cnt = 0;
  $.each(value, function (versionID, versionData) {
    cnt++;
    if (cnt <= listCount) {
      html.push('<a href="' + versionData.download_link + '" target="_blank" data-toggle="tooltip" data-html="true" title="' + getVersionDetails(versionData) + '"><span class="btn btn-' + getSecurityStatus(versionData) + ' btn-sm"><span class="glyphicon glyphicon-lock"></span> ' + versionID + '</span></a> ');
    }
  });

  return html.join('');
}

/**
 * Gets Version details for tooltip.
 *
 * @param versionData
 * @returns {string}
 */
function getVersionDetails(versionData) {
  var release_date = new Date(versionData.date * 1000);
  return release_date.toUTCString();
}

function getSecurityStatus(versionData) {
  var attr = versionData.security['@attributes'];
  var status = 'danger';
  if (attr != undefined && attr['covered'] == 1) {
    status = 'success';
  }
  return status;
}

/**
 *  Link formatter.
 *
 * @param value
 * @param row
 * @param index
 * @returns {string}
 * @constructor
 */
function LinkFormatterUrl(value, row, index) {
  var html = [];
  var cnt = 0;
  $.each(value,  function (userID, user) {
    cnt++;
    if (cnt <= listCount) {
      html.push('<a href="https://www.drupal.org/user/' + userID + '" target="_blank">' + user.name + '</a>');
    }
  });
  return html.join(', ');
}

/**
 *  Link formatter.
 *
 * @param value
 * @param row
 * @param index
 * @returns {string}
 * @constructor
 */
function ModuleFormatterUrl(value, row, index) {
  return '<a href="https://www.drupal.org/project/' + row.project + '" target="_blank">' + value + '</a>';
}