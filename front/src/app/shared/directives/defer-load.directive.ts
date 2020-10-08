import { Directive, ElementRef, EventEmitter, Output } from '@angular/core';

@Directive({
  selector: '[appDeferLoad]'
})
export class DeferLoadDirective {
  @Output() public discovered: EventEmitter<any> = new EventEmitter();

  private m_intersectionObserver?: IntersectionObserver;

  constructor(private m_element: ElementRef) { }

  ngAfterViewInit() {
    this.m_intersectionObserver = new IntersectionObserver(entries => {
      this.checkForIntersection(entries);
    }, {});
    this.m_intersectionObserver.observe(<Element>(this.m_element.nativeElement));
  }

  private checkForIntersection = (entries: Array<IntersectionObserverEntry>) => {
    entries.forEach((entry: IntersectionObserverEntry) => {
      if (this.checkIfIntersecting(entry)) {
        this.discovered.emit();
        this.m_intersectionObserver.unobserve(<Element>(this.m_element.nativeElement));
        this.m_intersectionObserver.disconnect();
      }
    });
  }

  private checkIfIntersecting(entry: IntersectionObserverEntry) {
    return (<any>entry).isIntersecting && entry.target === this.m_element.nativeElement;
  }
}
