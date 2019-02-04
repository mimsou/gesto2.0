import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DimentionComponent } from './dimention.component';

describe('DimentionComponent', () => {
  let component: DimentionComponent;
  let fixture: ComponentFixture<DimentionComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DimentionComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DimentionComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
