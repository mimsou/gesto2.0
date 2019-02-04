import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { OneInputFormComponent } from './one-input-form.component';

describe('OneInputFormComponent', () => {
  let component: OneInputFormComponent;
  let fixture: ComponentFixture<OneInputFormComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ OneInputFormComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(OneInputFormComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
