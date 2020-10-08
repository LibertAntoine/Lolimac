import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-top-app-bar',
  templateUrl: './top-app-bar.component.html',
  styleUrls: ['./top-app-bar.component.scss']
})
export class TopAppBarComponent implements OnInit {
  @Input() title: String;
  @Input() bReturn: Boolean;

  @Output() return = new EventEmitter<any>()

  constructor() { }

  ngOnInit() {
  }

  onReturn(event: any): void {
    this.return.emit(undefined);
  }

}
