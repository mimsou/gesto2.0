import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AutocomboComponent } from './autocombo.component';

describe('AutocomboComponent', () => {
  let component: AutocomboComponent;
  let fixture: ComponentFixture<AutocomboComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AutocomboComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AutocomboComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
