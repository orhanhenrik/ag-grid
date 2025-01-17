import { CellPosition, CellPositionUtils, Column, GridOptionsWrapper, GridPanel, IRangeController, CellRangeParams, CellRange, RowPosition, RowPositionUtils } from "@ag-grid-community/core";
export declare class RangeController implements IRangeController {
    private loggerFactory;
    private rowModel;
    private eventService;
    private columnController;
    private mouseEventService;
    private gridOptionsWrapper;
    private columnApi;
    private gridApi;
    private cellNavigationService;
    private pinnedRowModel;
    rowPositionUtils: RowPositionUtils;
    cellPositionUtils: CellPositionUtils;
    private logger;
    private gridPanel;
    private cellRanges;
    private lastMouseEvent;
    private bodyScrollListener;
    private newestRangeStartCell;
    private dragging;
    private draggingCell;
    private draggingRange;
    autoScrollService: AutoScrollService;
    registerGridComp(gridPanel: GridPanel): void;
    private init;
    onColumnVisibleChange(): void;
    refreshLastRangeStart(): void;
    isContiguousRange(cellRange: CellRange): boolean;
    getRangeStartRow(cellRange: CellRange): RowPosition;
    getRangeEndRow(cellRange: CellRange): RowPosition;
    setRangeToCell(cell: CellPosition, appendRange?: boolean): void;
    extendLatestRangeToCell(cellPosition: CellPosition): void;
    updateRangeEnd(params: {
        cellRange: CellRange;
        cellPosition: CellPosition;
    }): void;
    private refreshRangeStart;
    getRangeEdgeColumns(cellRange: CellRange): {
        left: Column;
        right: Column;
    };
    extendLatestRangeInDirection(key: number): CellPosition | undefined;
    setCellRange(params: CellRangeParams): void;
    setCellRanges(cellRanges: CellRange[]): void;
    createCellRangeFromCellRangeParams(params: CellRangeParams): CellRange | undefined;
    addCellRange(params: CellRangeParams): void;
    getCellRanges(): CellRange[];
    isEmpty(): boolean;
    isMoreThanOneCell(): boolean;
    removeAllCellRanges(silent?: boolean): void;
    private onBodyScroll;
    isCellInAnyRange(cell: CellPosition): boolean;
    isCellInSpecificRange(cell: CellPosition, range: CellRange): boolean;
    getCellRangeCount(cell: CellPosition): number;
    private isRowInRange;
    getDraggingRange(): CellRange | undefined;
    onDragStart(mouseEvent: MouseEvent): void;
    onDragging(mouseEvent: MouseEvent | null): void;
    onDragStop(): void;
    private onRangeChanged;
    private dispatchChangedEvent;
    private calculateColumnsBetween;
}
declare class AutoScrollService {
    private tickingInterval;
    private tickLeft;
    private tickRight;
    private tickUp;
    private tickDown;
    private gridPanel;
    private gridOptionsWrapper;
    private tickCount;
    constructor(gridPanel: GridPanel, gridOptionsWrapper: GridOptionsWrapper);
    check(mouseEvent: MouseEvent, skipVerticalScroll?: boolean): void;
    private ensureTickingStarted;
    private doTick;
    ensureCleared(): void;
}
export {};
