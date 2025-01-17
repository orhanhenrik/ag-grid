import {_, ChartType} from "@ag-grid-community/core";

import {MiniStackedArea} from "./miniStackedArea";

export class MiniNormalizedArea extends MiniStackedArea {
    static chartType = ChartType.NormalizedArea;
    static readonly data = MiniStackedArea.data.map(stack => {
        const sum = stack.reduce((p, c) => p + c, 0);
        return stack.map(v => v / sum * 16);
    });

    constructor(parent: HTMLElement, fills: string[], strokes: string[], data: number[][] = MiniNormalizedArea.data) {
        super(parent, fills, strokes, data, "normalizedAreaTooltip");
    }
}
