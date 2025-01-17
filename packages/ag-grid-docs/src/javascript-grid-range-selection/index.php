<?php
$pageTitle = "Range Selection: Enterprise Grade Feature of our Datagrid";
$pageDescription = "Core feature of ag-Grid supporting Angular, React, Javascript and more. One such feature is Range Selection. Drag the mouse over cells to create a Range Selection. This is handy for highlighting data or for copying to the clipboard. Version 20 is available for download now, take it for a free two month trial.";
$pageKeyboards = "range selection javascript grid ag-grid";
$pageGroup = "feature";
include '../documentation-main/documentation_header.php';
?>

<div>
    <h1 class="heading-enterprise">Range Selection</h1>

    <p class="lead">
        Range selection allows Excel-like range selection of cells.
        Range selections are useful for visually highlighting data, copying data to the
        <a href="../javascript-grid-clipboard/">Clipboard</a>
        or for doing aggregations using the <a href="../javascript-grid-status-bar/">Status Bar</a>.
    </p>

    <? enterprise_feature("Range Selection"); ?>

    <h2>Selecting Ranges</h2>

    <p>
        Ranges can be selected in the following ways:
        <ul>
            <li>
                <b>Mouse Drag:</b> Click the mouse down on a cell and drag and release the mouse over another cell.
                A range will be created between the two cells and clear any existing ranges.
            </li>
            <li>
                <b>Ctrl & Mouse Drag:</b> Holding <b>Control</b> key while creating a range using mouse drag
                will create a new range selection and keep any existing ranges.
            </li>
            <li>
                <b>Shift & Click:</b> Clicking on one cell to focus that cell, then hold down <b>Shift</b>
                while clicking another cell will create a range between both cells.
            </li>
            <li>
                <b>Shift & Arrow Keys:</b> Focusing a cell and then holding down <b>Shift</b> and using
                the arrow keys will create a range starting from the focused cell.
            </li>

        </ul>
    </p>

    <h2>Range Selection Example</h2>

    <p>
        The example below demonstrates simple range selection. Ranges can be selected in all ways
        described above.
    </p>

    <?= example('Range Selection', 'range-selection', 'generated', array("enterprise" => 1, "processVue" => true)) ?>

    <h2>Ranges with Pinning and Floating</h2>

    <p>
        It is possible to select a range that spans pinned and non-pinned sections of the grid.
        If you do this, the selected range will not have any gaps with regards to the column order.
        For example, if you start the drag on the left pinned area and drag to the right pinned
        area, then all of the columns in the center area will also be part of the range.
    </p>

    <p>
        Likewise with floating, no row gaps will occur if a range spans into pinned rows.
        A range will be continuous between the floating top rows, the center, and the floating
        bottom rows.
    </p>

    <p>
        The above two (pinning and floating) can be thought of as follows: if you have a grid
        with pinning and / or floating, then 'flatten out' the grid in your head so that all
        rows and columns are visible, then the range selection will work as you would expect
        in the flattened out version with only full rectangles can be selectable.
    </p>

    <h2>Range Changed Event</h2>

    <p>
        The <code>rangeSelectionChanged</code> event tells you that the range selection has changed.
        The event has two properties, <code>started</code> and <code>finished</code>, which are <code>true</code> when the selection
        is starting or finishing.
        For example, if selecting a range of 10 cells in a row, the user will click the first
        cell and drag to the last cell. This will result in up to 11 events. The first event
        will have <code>started=true</code>, the last will have <code>finished=true</code>, and
        all the intermediary events will have both of these values as <code>false</code>.
    </p>

    <snippet>
api.addEventListener('rangeSelectionChanged', function(event) {
    // this prints true for first event only
    console.log('has changed, started = ' + event.started);
    // this prints true for last event only
    console.log('has changed, finished = ' + event.finished);
});</snippet>

    <h2>Range Selection API</h2>

    <h3><code>api.getCellRanges()</code></h3>

    <p>
        Get the selected ranges using <code>api.getCellRanges()</code>. This will return back
        a list of cell range objects, each of which contains the details of one range. The
        structure of the cell range object is as follows:
    </p>

        <snippet>
interface CellRange {
    startRow: RowPosition; // the start row of the range
    endRow: RowPosition; // the end row of the range
    columns: Column[] // the columns in the range
}

interface RowPosition {
    rowIndex: number;
    rowPinned: string | undefined;
}
</snippet>

    <p>
        The start is the first cell the user clicked on and the end is the cell where
        the user stopped dragging. Do not assume that the start cell's index is numerically
        before the end cell, as the user could have dragged up.
    </p>

    <h3><code>api.clearRangeSelection()</code></h3>

    <p>
        Clears the range selection.
    </p>

    <h3><code>api.addCellRange(rangeSelection)</code></h3>

    <p>
        Adds a range to the selection. This keeps any previous ranges. If you wish to have this range
    exclusively, then call <code>clearRangeSelection()</code> first. The method takes the following params:
    </p>

        <snippet>
interface AddCellRangeParams {

    // start row
    rowStartIndex?: number;
    rowStartPinned?: string; // either 'top', 'bottom' or undefined

    // end row
    rowEndIndex?: number;
    rowEndPinned?: string; // either 'top', 'bottom' or undefined

    // columns
    columnStart?: string | Column;
    columnEnd?: string | Column;
    columns?: (string | Column)[];
}
</snippet>

    <p>
        Ranges are normally bounded by a start and end row. However it is also possible to define a range
        unbounded by rows (i.e. to contain all rows). For an unbounded range, do not provide start or end
        row positions.
    </p>

    <p>
        Row positions are defined by a row index and pinned. Row indexes start at zero and increment. Pinned
        can be either <code>'top'</code> (row is in pinned top section), <code>'bottom'</code> (row is in pinned bottom section) or
        <code>undefined</code> (row is in the main body). See <a href="../javascript-grid-row-pinning">Row Pinning</a>
        for information on row pinning.
    </p>

    <p>
        Ranges are defined by a list of columns. Pass in either a) a list of columns or b) a start and end
        column and let the grid work out the columns in between. Passing a list of columns instead of a start and
        end column has the advantage that the columns do not need to be contiguous.
    </p>

    <h3>Callback <code>processCellForClipboard()</code></h3>

    <p>
        There is a grid callback <code>processCellForClipboard()</code> that allows you to format cells before
        going to the clipboard. This can be useful if, for example, you are pasting to Excel and you need to
        format dates so that Excel can understand them.
    </p>

    <p>
        The callback params has the following attributes: <code>value, node, column, api, columnApi, context, type</code>.
    </p>

    <h2>Copy Range Down</h2>

    <p>
        When you have more than one row selected in a range, pressing keys <kbd>Ctrl + D</kbd> will copy
        the range down.
    </p>

    <h2>Advanced Range Selection Example</h2>

    <p>
        The example below demonstrates a more complex range selection scenario. The example listens
        for the <code>rangeSelectionChanged</code> event and creates a sum of all the number values
        that are in the range (it ignores all non-number values). The <code>finished</code> flag
        is used to update the eager and lazy figures separately.
    </p>

    <p>
        The example also shows use of <code>processCellForClipboard()</code> and <code>processCellFromClipboard()</code>
        by making all the athlete names uppercase when copying into the clipboard and lowercase when
        copying from the clipboard.
    </p>

    <?= example('Advanced Range Selection', 'range-selection-advanced', 'generated', array("enterprise" => 1, "processVue" => true)) ?>

    <h2>Range Selection Example - Suppress Multi</h2>

    <p>
        This example differs from above as <code>suppressMultiRangeSelection=true</code> which only allows
        one range selection even if the Ctrl key is held down.
    </p>

    <?= example('Range Selection Suppress Multi', 'range-selection-suppress-multi', 'generated', array("enterprise" => 1, "processVue" => true)) ?>

</div>

<?php include '../documentation-main/documentation_footer.php';?>
