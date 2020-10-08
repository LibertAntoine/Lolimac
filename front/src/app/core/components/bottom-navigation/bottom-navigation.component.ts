import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-bottom-navigation',
  templateUrl: './bottom-navigation.component.html',
  styleUrls: ['./bottom-navigation.component.scss']
})
export class BottomNavigationComponent implements OnInit {
  @Input() notifCount: number;

  constructor() { }

  ngOnInit() {
  }

}
